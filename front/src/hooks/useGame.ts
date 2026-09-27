"use client";

import { useCallback, useEffect, useState } from "react";
import {
  isGameApiError,
  startGame as apiStartGame,
  submitAnswer as apiSubmitAnswer,
  undoAnswer as apiUndoAnswer,
} from "@/lib/game-api";

export type GamePhase = "booting" | "playing" | "won" | "lost";

export type AnswerOption = {
  label: string;
  score: number;
};

export const ANSWER_OPTIONS: AnswerOption[] = [
  { label: "SIM", score: 2 },
  { label: "PROVAVELMENTE SIM", score: 1.5 },
  { label: "TALVEZ / NÃO SEI", score: 1 },
  { label: "PROVAVELMENTE NÃO", score: 0.5 },
  { label: "NÃO", score: 0 },
];

function getUserFacingErrorMessage(
  error: unknown,
  fallbackMessage: string,
): string {
  if (!isGameApiError(error)) {
    return fallbackMessage;
  }

  if (error.status === 500) {
    return "Não foi possível processar sua solicitação, tente novamente mais tarde";
  }

  return error.message;
}

export function useGame() {
  const [phase, setPhase] = useState<GamePhase>("booting");
  const [playerId, setPlayerId] = useState<number | null>(null);
  const [question, setQuestion] = useState<string | null>(null);
  const [attributeId, setAttributeId] = useState<number | null>(null);
  const [characterName, setCharacterName] = useState<string | null>(null);
  const [errorMessage, setErrorMessage] = useState<string | null>(null);
  const [isSubmitting, setIsSubmitting] = useState(false);
  const [answeredAttributeIds, setAnsweredAttributeIds] = useState<number[]>([]);
  const canGoBack = answeredAttributeIds.length > 0;

  const startGame = useCallback(async () => {
    setPhase("booting");
    setPlayerId(null);
    setQuestion(null);
    setAttributeId(null);
    setCharacterName(null);
    setErrorMessage(null);
    setAnsweredAttributeIds([]);
    setIsSubmitting(true);

    try {
      const data = await apiStartGame();
      setPlayerId(data.player);
      setQuestion(data.question ?? null);
      setAttributeId(data.attribute_id ?? null);
      setPhase("playing");
    } catch (error) {
      setErrorMessage(getUserFacingErrorMessage(error, "Falha ao iniciar o terminal."));
      setPhase("lost");
    } finally {
      setIsSubmitting(false);
    }
  }, []);

  const submitAnswer = useCallback(
    async (answerScore: number) => {
      if (playerId === null || attributeId === null || isSubmitting) {
        return;
      }

      const answeredAttributeId = attributeId;

      setIsSubmitting(true);

      try {
        const data = await apiSubmitAnswer(playerId, attributeId, answerScore);

        if (data.possible_character) {
          setCharacterName(data.possible_character);
          setPhase("won");
          return;
        }

        setPlayerId(data.player);
        setQuestion(data.question ?? null);
        setAttributeId(data.attribute_id ?? null);
        setAnsweredAttributeIds((ids) => [...ids, answeredAttributeId]);
        setPhase("playing");
      } catch (error) {
        setErrorMessage(
          getUserFacingErrorMessage(error, "Personagem não encontrado!"),
        );
        setPhase("lost");
      } finally {
        setIsSubmitting(false);
      }
    },
    [attributeId, isSubmitting, playerId],
  );

  const goBack = useCallback(async () => {
    if (playerId === null || !canGoBack || isSubmitting) {
      return;
    }

    setIsSubmitting(true);

    const attributeToUndo = answeredAttributeIds[answeredAttributeIds.length - 1];

    try {
      const data = await apiUndoAnswer(playerId, attributeToUndo);
      setPlayerId(data.player);
      setQuestion(data.question ?? null);
      setAttributeId(data.attribute_id ?? null);
      setAnsweredAttributeIds((ids) => ids.slice(0, -1));
      setPhase("playing");
    } catch (error) {
      setErrorMessage(getUserFacingErrorMessage(error, "Falha ao voltar."));
      setPhase("lost");
    } finally {
      setIsSubmitting(false);
    }
  }, [answeredAttributeIds, canGoBack, isSubmitting, playerId]);

  const restart = useCallback(() => {
    void startGame();
  }, [startGame]);

  useEffect(() => {
    void startGame();
  }, [startGame]);

  return {
    phase,
    question,
    characterName,
    errorMessage,
    isSubmitting,
    canGoBack,
    submitAnswer,
    goBack,
    restart,
  };
}
