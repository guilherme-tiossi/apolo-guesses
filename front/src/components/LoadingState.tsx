type LoadingStateProps = {
  message: string;
};

export function LoadingState({ message }: LoadingStateProps) {
  return (
    <div className="py-8 text-center">
      <p className="text-xl text-amber-dim md:text-2xl">
        {message}
        <span className="animate-blink ml-1 inline-block text-amber">_</span>
      </p>
    </div>
  );
}
