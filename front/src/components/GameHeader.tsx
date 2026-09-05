export function GameHeader() {
  return (
    <header className="mb-10 text-center">
      <h1
        className="text-glow text-3xl leading-relaxed tracking-wider text-amber md:text-4xl"
        style={{ fontFamily: "var(--font-pixel-title)" }}
      >
        APOLO
      </h1>
      <p className="mt-5 text-2xl text-amber-dim md:text-3xl">
        &gt; TERMINAL DE ADIVINHAÇÃO v1.0
      </p>
    </header>
  );
}
