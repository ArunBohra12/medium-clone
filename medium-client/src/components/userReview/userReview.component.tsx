import './userReview.styles.scss';

type UserReviewProps = {
  userImage: string;
  userName: string;
  quote: string;
};

const UserReview = ({ userImage, userName, quote }: UserReviewProps): JSX.Element => {
  return (
    <>
      <div className="user-review-image">
        <img src={userImage} alt={userName} />
        <div className="review-half-circle"></div>
        <div className="review-small-circle"></div>
      </div>
      <div className="user-review-quote">"{quote}"</div>
      <div className="user-review-name">{userName}</div>
    </>
  );
};

export default UserReview;
