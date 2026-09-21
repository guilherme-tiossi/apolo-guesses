import { BackButton } from "@/components/BackButton";

type QuestionViewProps = {
  question: string | null;
  canGoBack?: boolean;
  isSubmitting?: boolean;
  onBack?: () => void;
};

export function QuestionView({
  question,
  canGoBack = false,
  isSubmitting = false,
  onBack,
}: QuestionViewProps) {
  return (
    <div className="mb-6 min-h-[4rem]">
      <p className="mb-3 text-lg uppercase tracking-widest text-amber-dim md:text-xl">
        &gt; PERGUNTA:
      </p>
      <div className="flex items-end justify-between gap-6">
        <p className="min-w-0 flex-1 text-2xl leading-snug text-phosphor md:text-3xl">
          {question ?? "..."}
          <span className="animate-blink ml-1 inline-block text-amber">_</span>
        </p>
        {onBack && (
          <BackButton
            disabled={!canGoBack || isSubmitting}
            onBack={onBack}
          />
        )}
      </div>
    </div>
  );
}
