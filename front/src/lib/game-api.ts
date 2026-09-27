export type GameResponse = {
  player: number;
  question?: string | null;
  attribute_id?: number | null;
  possible_character?: string | null;
};

export type GameApiError = {
  message: string;
  errorKey?: string;
  status?: number;
};

const API_URL = process.env.NEXT_PUBLIC_API_URL ?? "http://localhost:8001";

async function parseApiError(response: Response): Promise<GameApiError> {
  try {
    const body = await response.json();

    return {
      message:
        typeof body?.message === "string"
          ? body.message
          : typeof body?.error === "string"
            ? body.error
            : `Erro ${response.status}: falha na comunicação com o terminal.`,
      errorKey: typeof body?.error_key === "string" ? body.error_key : undefined,
      status: response.status,
    };
  } catch {
    // ignore parse errors
  }

  return {
    message: `Erro ${response.status}: falha na comunicação com o terminal.`,
    status: response.status,
  };
}

export async function startGame(): Promise<GameResponse> {
  const response = await fetch(`${API_URL}/game`, {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({}),
  });

  if (!response.ok) {
    throw await parseApiError(response);
  }

  const body = await response.json();
  return body.data as GameResponse;
}

export async function undoAnswer(
  playerId: number,
  attributeId: number,
): Promise<GameResponse> {
  const response = await fetch(`${API_URL}/game/back`, {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ player_id: playerId, attribute_id: attributeId }),
  });

  if (!response.ok) {
    throw await parseApiError(response);
  }

  const body = await response.json();
  return body.data as GameResponse;
}

export async function submitAnswer(
  playerId: number,
  attributeId: number,
  answerScore: number,
): Promise<GameResponse> {
  const response = await fetch(`${API_URL}/game`, {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({
      player_id: playerId,
      attribute_id: attributeId,
      answer_score: answerScore,
    }),
  });

  if (!response.ok) {
    throw await parseApiError(response);
  }

  const body = await response.json();
  return body.data as GameResponse;
}

export function isGameApiError(error: unknown): error is GameApiError {
  return (
    typeof error === "object" &&
    error !== null &&
    "message" in error &&
    typeof (error as GameApiError).message === "string"
  );
}
