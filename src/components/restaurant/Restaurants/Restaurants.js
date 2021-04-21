import Restaurant from "../Restaurant/Restaurant";
import "./Restaurants.css";
import resto1 from "../../../asssets/resto1.jpeg";
import resto2 from "../../../asssets/resto2.jpeg";
import resto3 from "../../../asssets/resto3.jpeg";
import resto4 from "../../../asssets/resto4.jpeg";

const Restaurants = function () {
  return (
    <div className="restaurants">
      <Restaurant
        nama="Nama Restoran 1"
        alamat="Alamat 1"
        rate="2.0/5.0"
        imageUrl={resto1}
      />
      <Restaurant
        nama="Nama Restoran 2"
        alamat="Alamat 2"
        rate="3.0/5.0"
        imageUrl={resto2}
      />
      <Restaurant
        nama="Nama Restoran 3"
        alamat="Alamat 3"
        rate="4.0/5.0"
        imageUrl={resto3}
      />
      <Restaurant
        nama="Nama Restoran 4"
        alamat="Alamat 4"
        rate="5.0/5.0"
        imageUrl={resto4}
      />
    </div>
  );
};

export default Restaurants;
