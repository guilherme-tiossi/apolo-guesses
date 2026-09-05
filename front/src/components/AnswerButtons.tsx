"use client";

import { useCallback, useEffect, useRef, useState } from "react";
import type { AnswerOption } from "@/hooks/useGame";

type AnswerButtonsProps = {
  options: AnswerOption[];
  disabled: boolean;
  menuKey: string;
  onAnswer: (score: number) => void;
};

export function AnswerButtons({
  options,
  disabled,
  menuKey,
  onAnswer,
}: AnswerButtonsProps) {
  const [selectedIndex, setSelectedIndex] = useState(0);
  const menuRef = useRef<HTMLDivElement>(null);
  const selectedIndexRef = useRef(0);

  useEffect(() => {
    setSelectedIndex(0);
    selectedIndexRef.current = 0;
  }, [menuKey]);

  useEffect(() => {
    if (disabled) {
      return;
    }

    menuRef.current?.focus();
  }, [disabled, menuKey]);

  const select = useCallback(
    (index: number) => {
      if (disabled) {
        return;
      }

      onAnswer(options[index].score);
    },
    [disabled, onAnswer, options],
  );

  const moveSelection = useCallback(
    (direction: 1 | -1) => {
      setSelectedIndex((current) => {
        const next = (current + direction + options.length) % options.length;
        selectedIndexRef.current = next;
        return next;
      });
    },
    [options.length],
  );

  const handleKeyDown = useCallback(
    (event: React.KeyboardEvent<HTMLDivElement>) => {
      if (disabled) {
        return;
      }

      if (event.key === "ArrowDown") {
        event.preventDefault();
        moveSelection(1);
        return;
      }

      if (event.key === "ArrowUp") {
        event.preventDefault();
        moveSelection(-1);
        return;
      }

      if (event.key === "Enter") {
        event.preventDefault();
        select(selectedIndexRef.current);
      }
    },
    [disabled, moveSelection, select],
  );

  return (
    <div
      ref={menuRef}
      tabIndex={0}
      onKeyDown={handleKeyDown}
      className="menu-list outline-none"
      role="listbox"
      aria-label="Opções de resposta"
      aria-activedescendant={`answer-option-${selectedIndex}`}
    >
      {options.map((option, index) => {
        const isSelected = index === selectedIndex;

        return (
          <div
            key={option.label}
            id={`answer-option-${index}`}
            role="option"
            aria-selected={isSelected}
            onClick={() => !disabled && select(index)}
            onMouseEnter={() => {
              setSelectedIndex(index);
              selectedIndexRef.current = index;
            }}
            className={`menu-item px-6 py-5 text-3xl uppercase tracking-wide transition-colors md:text-4xl ${
              disabled ? "cursor-not-allowed opacity-50" : ""
            } ${
              isSelected
                ? "menu-selected"
                : "pixel-border bg-secondary text-secondary-foreground hover:bg-accent hover:text-accent-foreground"
            }`}
          >
            <span className={isSelected ? "animate-blink inline-block" : ""}>
              &gt; {option.label}
            </span>
          </div>
        );
      })}
    </div>
  );
}
