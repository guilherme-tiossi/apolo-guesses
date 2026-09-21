"use client";

import { AnswerButtons } from "@/components/AnswerButtons";
import { CrtPanel } from "@/components/CrtPanel";
import { GameHeader } from "@/components/GameHeader";
import { LoadingState } from "@/components/LoadingState";
import { QuestionView } from "@/components/QuestionView";
import { ResultScreen } from "@/components/ResultScreen";
import { ANSWER_OPTIONS, useGame } from "@/hooks/useGame";

export default function HomePage() {
  const {
    phase,
    question,
    characterName,
    errorMessage,
    isSubmitting,
    canGoBack,
    submitAnswer,
    goBack,
    restart,
  } = useGame();

  return (
    <main className="relative z-10 mx-auto flex min-h-dvh max-w-4xl items-start overflow-y-auto px-4 py-4 md:py-6">
      <CrtPanel className="w-full">
        <GameHeader />

        {phase === "booting" && (
          <LoadingState message="INICIANDO TERMINAL..." />
        )}

        {phase === "playing" && (
          <>
            <QuestionView
              question={question}
              canGoBack={canGoBack}
              isSubmitting={isSubmitting}
              onBack={() => void goBack()}
            />
            {isSubmitting ? (
              <LoadingState message="PROCESSANDO..." />
            ) : (
              <AnswerButtons
                options={ANSWER_OPTIONS}
                disabled={isSubmitting}
                menuKey={question ?? "boot"}
                onAnswer={(score) => void submitAnswer(score)}
              />
            )}
          </>
        )}

        {(phase === "won" || phase === "lost") && (
          <ResultScreen
            type={phase}
            characterName={characterName}
            errorMessage={errorMessage}
            onRestart={restart}
          />
        )}
      </CrtPanel>
    </main>
  );
}
