import "./Button.css";

const Button = function (props) {
  return (
    <div>
      <button className="custom-button">{props.text}</button>
    </div>
  );
};

export default Button;
