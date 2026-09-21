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
        className={`mb-4 text-lg uppercase tracking-widest md:text-xl ${isWin ? "text-amber" : "text-destructive"}`}
      >
        {isWin ? "&gt; RESULTADO: SUCESSO" : "&gt; RESULTADO: FALHA"}
      </p>

      {isWin ? (
        <p className="text-glow mb-6 text-2xl leading-relaxed text-phosphor md:text-3xl">
          EU ACHO QUE É:
          <br />
          <span className="mt-2 inline-block text-3xl text-amber md:text-4xl">
            {characterName}
          </span>
        </p>
      ) : (
        <p className="mb-6 text-2xl leading-relaxed text-destructive md:text-3xl">
          {errorMessage ?? "Personagem não encontrado!"}
        </p>
      )}

      <button
        type="button"
        onClick={handleRestart}
        onMouseEnter={() => setSelected(true)}
        className={`px-6 py-3 text-xl uppercase tracking-wide transition-colors md:text-2xl ${
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
