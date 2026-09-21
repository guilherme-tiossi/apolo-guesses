export function GameHeader() {
  return (
    <header className="mb-6 text-center">
      <h1
        className="text-glow text-2xl leading-relaxed tracking-wider text-amber md:text-3xl"
        style={{ fontFamily: "var(--font-pixel-title)" }}
      >
        APOLO
      </h1>
      <p className="mt-3 text-xl text-amber-dim md:text-2xl">
        &gt; TERMINAL DE ADIVINHAÇÃO v1.0
      </p>
    </header>
  );
}
