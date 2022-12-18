import Sections from './sections/index.ts';

const LandingPage = ():JSX.Element => {
  return (
    <>
      <Sections.HeaderSection />
      <Sections.IdeasSection />
    </>
  );
}

export default LandingPage;
