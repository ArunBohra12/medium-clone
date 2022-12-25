import Sections from './sections/index';

const LandingPage = (): JSX.Element => {
  return (
    <>
      <Sections.HeaderSection />
      <Sections.IdeasSection />
      <Sections.TotalReaders />
      <Sections.CtaSection />
      <Sections.Footer />
    </>
  );
};

export default LandingPage;
