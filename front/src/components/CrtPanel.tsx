import type { ReactNode } from "react";

type CrtPanelProps = {
  children: ReactNode;
  className?: string;
};

export function CrtPanel({ children, className = "" }: CrtPanelProps) {
  return (
    <div
      className={`pixel-border bg-card text-card-foreground p-4 md:p-6 ${className}`}
    >
      {children}
    </div>
  );
}
