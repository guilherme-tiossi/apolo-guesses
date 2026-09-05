import type { ReactNode } from "react";

type CrtPanelProps = {
  children: ReactNode;
  className?: string;
};

export function CrtPanel({ children, className = "" }: CrtPanelProps) {
  return (
    <div
      className={`pixel-border bg-card text-card-foreground p-6 md:p-8 ${className}`}
    >
      {children}
    </div>
  );
}
