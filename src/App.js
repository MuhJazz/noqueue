import "./App.css";
import Header from "./components/header/Header";
import Section from "./components/section/Section";
import Button from "./components/button/Button";
import Restaurants from "./components/restaurant/Restaurants/Restaurants";

function App() {
  return (
    <div className="App">
      <Header />
      <Section>
        <div className="rekomendasi">
          <p>Rekomendasi untuk kamu!</p>
          <Button text="TELUSURI" />
        </div>
        <Restaurants />
      </Section>
    </div>
  );
}

export default App;
