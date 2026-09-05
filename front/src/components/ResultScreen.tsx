"use client";

import { useCallback, useEffect, useState } from "react";

type ResultScreenProps = {
  type: "won" | "lost";
  characterName?: string | null;
  errorMessage?: string | null;
  onRestart: () => void;
};

export function ResultScreen({
  type,
  characterName,
  errorMessage,
  onRestart,
}: ResultScreenProps) {
  const [selected, setSelected] = useState(true);
  const isWin = type === "won";

  const handleRestart = useCallback(() => {
    onRestart();
  }, [onRestart]);

  useEffect(() => {
    const handleKeyDown = (event: KeyboardEvent) => {
      if (event.key === "Enter") {
        event.preventDefault();
        handleRestart();
      }
    };

    window.addEventListener("keydown", handleKeyDown);

    return () => window.removeEventListener("keydown", handleKeyDown);
  }, [handleRestart]);

  return (
    <div className="text-center">
      <p
        className={`mb-6 text-xl uppercase tracking-widest md:text-2xl ${isWin ? "text-amber" : "text-destructive"}`}
      >
        {isWin ? "&gt; RESULTADO: SUCESSO" : "&gt; RESULTADO: FALHA"}
      </p>

      {isWin ? (
        <p className="text-glow mb-10 text-3xl leading-relaxed text-phosphor md:text-4xl">
          EU ACHO QUE É:
          <br />
          <span className="mt-3 inline-block text-4xl text-amber md:text-5xl">
            {characterName}
          </span>
        </p>
      ) : (
        <p className="mb-10 text-3xl leading-relaxed text-destructive md:text-4xl">
          {errorMessage ?? "Personagem não encontrado!"}
        </p>
      )}

      <button
        type="button"
        onClick={handleRestart}
        onMouseEnter={() => setSelected(true)}
        className={`px-8 py-5 text-2xl uppercase tracking-wide transition-colors md:text-3xl ${
          selected
            ? "pixel-border-accent bg-amber text-black"
            : "pixel-border-accent bg-primary text-primary-foreground"
        }`}
      >
        <span className={selected ? "animate-blink inline-block" : ""}>
          &gt; JOGAR DE NOVO
        </span>
      </button>
    </div>
  );
}
