import mTextImage from '../../../assets/images/mText.svg';

import Button from '../../../components/button/button.component';

import './headerSection.styles.scss';

const HeaderSection = (): JSX.Element => {
  return (
    <header className="header-section">
      <div className="hero-div">
        <div>
          <h1>Stay Curious</h1>
          <p>Discover stories, thinking, and expertise<br /> from writers on any topic.</p>
          <Button>Start Reading</Button>
        </div>
      </div>

      <img src={mTextImage} className="m-text-image" alt="Medium" />
    </header>
  );
}

export default HeaderSection;
