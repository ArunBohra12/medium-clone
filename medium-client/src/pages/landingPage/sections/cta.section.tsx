import Button from '../../../components/button/button.component';

import './ctaSection.styles.scss';

const CtaSection = (): JSX.Element => {
  return (
    <section className="cta-section">
      <div className="spinning-box">
          <iframe
            src="https://player.vimeo.com/video/448735219?api=1&background=1&mute=1&loop=1"
            width="100%"
            height="100%"
            allow="autoplay; fullscreen"
          ></iframe>
      </div>
      <div className="cta-container">
        <h2>Read, write, and expand your world.</h2>
        <Button variant="light-green">Get Started</Button>
      </div>
    </section>
  );
}

export default CtaSection;
