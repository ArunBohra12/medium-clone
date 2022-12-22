import Carousel from '../../../components/carousel/carousel.component';
import UserReview from '../../../components/userReview/userReview.component';
import { userReviews } from './userReviewsData';

import './totalReaders.styles.scss';

const TotalReaders = (): JSX.Element => {
  return (
    <div className="total-readers-section">
      <div className="total-readers-section-heading">
        <h2>Over 100 million users and growing</h2>
      </div>
      <div className="user-reviews-carousel">
        <Carousel
          items={userReviews.map((el) => (
            <UserReview key={el.id} {...el} />
          ))}
        />
      </div>
    </div>
  );
};

export default TotalReaders;
