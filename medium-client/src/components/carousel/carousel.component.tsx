import { useState, useEffect } from 'react';

import './carousel.styles.scss';

type CarouselProps = {
  items: Array<JSX.Element>;
};

const Carousel = ({ items }: CarouselProps): JSX.Element => {
  const [counter, setCounter] = useState<number>(0);

  const nextCounter = (count: number): number => {
    if (count === items.length - 1) return 0;

    return count + 1;
  };

  useEffect(() => {
    const interval = setInterval(() => {
      setCounter((prevSlideNo) => nextCounter(prevSlideNo));
    }, 10000);

    return () => clearInterval(interval);
  }, []);

  return (
    <div className="carousel">
      {items.map((item, index) => (
        <div key={index} className={`carousel-item ${index === counter ? 'show' : 'dont-show'}`}>
          {item}
        </div>
      ))}
    </div>
  );
};

export default Carousel;
