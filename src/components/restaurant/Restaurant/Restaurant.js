import "./Restaurant.css";

const Restaurant = function (props) {
  return (
    <div className="card">
      <div
        className="card-image"
        style={{
          backgroundImage: `url(${props.imageUrl})`,
        }}
      ></div>
      <div className="card-content">
        <span className="nama-resto">{props.nama}</span>
        <span className="alamat">{props.alamat}</span>
        <span className="rate">{props.rate}</span>
      </div>
    </div>
  );
};

export default Restaurant;
