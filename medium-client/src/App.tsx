import Navbar from './components/navbar/navbar.component';
import LandingPage from './pages/landingPage/landingPage.component.tsx';

import './sass/main.scss';

const App = (): JSX.Element => {
  return (
    <>
      <Navbar />
      <LandingPage />
    </>
  );
}

export default App;
