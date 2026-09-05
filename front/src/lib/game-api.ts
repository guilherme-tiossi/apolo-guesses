export type GameResponse = {
  player: number;
  question?: string | null;
  attribute_id?: number | null;
  possible_character?: string | null;
};

export type GameApiError = {
  message: string;
};

const API_URL = process.env.NEXT_PUBLIC_API_URL ?? "http://localhost:8000";

async function parseErrorMessage(response: Response): Promise<string> {
  try {
    const body = await response.json();
    if (typeof body?.message === "string") {
      return body.message;
    }
    if (typeof body?.error === "string") {
      return body.error;
    }
  } catch {
    // ignore parse errors
  }

  return `Erro ${response.status}: falha na comunicação com o terminal.`;
}

export async function startGame(): Promise<GameResponse> {
  const response = await fetch(`${API_URL}/game`, {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({}),
  });

  if (!response.ok) {
    throw { message: await parseErrorMessage(response) } satisfies GameApiError;
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
    throw { message: await parseErrorMessage(response) } satisfies GameApiError;
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
