"use client";

import { useState } from "react";

type BackButtonProps = {
  disabled: boolean;
  onBack: () => void;
};

export function BackButton({ disabled, onBack }: BackButtonProps) {
  const [isSelected, setIsSelected] = useState(false);

  return (
    <button
      type="button"
      disabled={disabled}
      onClick={onBack}
      onMouseEnter={() => !disabled && setIsSelected(true)}
      onMouseLeave={() => setIsSelected(false)}
      onFocus={() => !disabled && setIsSelected(true)}
      onBlur={() => setIsSelected(false)}
      className={`shrink-0 px-4 py-2 text-lg uppercase tracking-wide whitespace-nowrap transition-colors md:text-xl ${
        disabled
          ? "cursor-not-allowed opacity-50 pixel-border bg-secondary text-secondary-foreground"
          : isSelected
            ? "menu-selected"
            : "pixel-border bg-secondary text-secondary-foreground hover:bg-accent hover:text-accent-foreground"
      }`}
    >
      <span className={isSelected && !disabled ? "animate-blink inline-block" : ""}>
        &gt; VOLTAR
      </span>
    </button>
  );
}
