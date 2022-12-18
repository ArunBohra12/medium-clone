import mediumLogo from '../../../assets/images/wordmark.svg';

import './ideasSection.styles.scss';

const IdeasSection = (): JSX.Element => {
  return (
    <section className="ideas-section">
      <div className="ideas-section-heading">
        <h2>Every idea needs a</h2>
        <img className="medium-logo-in-hero" src={mediumLogo} alt="Medium Woodmark" />
      </div>
      <div className="idea-details">
        <p>
          The best ideas can change who we are. Medium is where those ideas take shape, take off, and spark powerful
          conversations. We're an open platform where over 100 million readers come to find insightful and dynamic
          thinking. Here, expert and undiscovered voices alike dive into the heart of any topic and bring new ideas to
          the surface. Our purpose is to spread these ideas and deepen understanding of the world.
          <br />
          <br />
          We're creating a new model for digital publishing. One that supports nuance, complexity, and vital
          storytelling without giving in to the incentives of advertising. It's an environment that's open to everyone
          but promotes substance and authenticity. And it's where deeper connections forged between readers and writers
          can lead to discovery and growth. Together with millions of collaborators, we're building a trusted and
          vibrant ecosystem fueled by important ideas and the people who think about them.
        </p>

        <div>
          <iframe
            src="https://player.vimeo.com/video/467834328?api=1&amp;background=1&amp;mute=1&amp;loop=1"
            width="100%"
            height="100%"
            allow="autoplay; fullscreen"
          ></iframe>
        </div>
      </div>
    </section>
  );
};

export default IdeasSection;
