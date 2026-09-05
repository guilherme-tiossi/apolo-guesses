type LoadingStateProps = {
  message: string;
};

export function LoadingState({ message }: LoadingStateProps) {
  return (
    <div className="py-12 text-center">
      <p className="text-3xl text-amber-dim md:text-4xl">
        {message}
        <span className="animate-blink ml-1 inline-block text-amber">_</span>
      </p>
    </div>
  );
}
