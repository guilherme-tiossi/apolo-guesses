"use client";

import { useCallback, useEffect, useState } from "react";
import {
  isGameApiError,
  startGame as apiStartGame,
  submitAnswer as apiSubmitAnswer,
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

export function useGame() {
  const [phase, setPhase] = useState<GamePhase>("booting");
  const [playerId, setPlayerId] = useState<number | null>(null);
  const [question, setQuestion] = useState<string | null>(null);
  const [attributeId, setAttributeId] = useState<number | null>(null);
  const [characterName, setCharacterName] = useState<string | null>(null);
  const [errorMessage, setErrorMessage] = useState<string | null>(null);
  const [isSubmitting, setIsSubmitting] = useState(false);

  const startGame = useCallback(async () => {
    setPhase("booting");
    setPlayerId(null);
    setQuestion(null);
    setAttributeId(null);
    setCharacterName(null);
    setErrorMessage(null);
    setIsSubmitting(true);

    try {
      const data = await apiStartGame();
      setPlayerId(data.player);
      setQuestion(data.question ?? null);
      setAttributeId(data.attribute_id ?? null);
      setPhase("playing");
    } catch (error) {
      setErrorMessage(
        isGameApiError(error)
          ? error.message
          : "Falha ao iniciar o terminal.",
      );
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
        setPhase("playing");
      } catch (error) {
        setErrorMessage(
          isGameApiError(error)
            ? error.message
            : "Personagem não encontrado!",
        );
        setPhase("lost");
      } finally {
        setIsSubmitting(false);
      }
    },
    [attributeId, isSubmitting, playerId],
  );

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
    submitAnswer,
    restart,
  };
}
