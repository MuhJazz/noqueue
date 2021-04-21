const Section = function (props) {
  return (
    <div>
      {props.children}
      <hr style={{ marginBottom: "200px" }} />
    </div>
  );
};

export default Section;
