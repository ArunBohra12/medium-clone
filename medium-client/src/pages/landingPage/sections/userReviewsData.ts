import JasmineBinaPhoto from '../../../assets/images/JasmineBina.png';
import JoelLeonPhoto from '../../../assets/images/JoelLeon.png';
import JackieColburnPhoto from '../../../assets/images/JackieColburn.png';

import { UserReviewType } from '../../../types/siteReviews';

export const userReviews: Array<UserReviewType> = [
  {
    id: 1,
    userName: 'Jasmine Bina',
    userImage: JasmineBinaPhoto,
    quote:
      "There's no other place that combines such an excellent level of writing with a truly engaged and active community. Medium is truly where ideas are born, shared, and spread.",
  },
  {
    id: 2,
    userName: 'Joel Leon',
    userImage: JoelLeonPhoto,
    quote:
      'Medium is trying to shift the paradigm. They’re catering to those looking for fresh, new, authentic voices. I believe wholeheartedly in their mission.',
  },
  {
    id: 3,
    userName: 'Jackie Colburn',
    userImage: JackieColburnPhoto,
    quote:
      'Medium is a great place to read and learn from a wide range of authors. It’s not muddied up by ads. It feels like one of the few pure places to go online.',
  },
];
