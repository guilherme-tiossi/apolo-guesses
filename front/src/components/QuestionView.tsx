type QuestionViewProps = {
  question: string | null;
};

export function QuestionView({ question }: QuestionViewProps) {
  return (
    <div className="mb-10 min-h-[6rem]">
      <p className="mb-3 text-xl uppercase tracking-widest text-amber-dim md:text-2xl">
        &gt; PERGUNTA:
      </p>
      <p className="text-4xl leading-snug text-phosphor md:text-5xl">
        {question ?? "..."}
        <span className="animate-blink ml-1 inline-block text-amber">_</span>
      </p>
    </div>
  );
}
