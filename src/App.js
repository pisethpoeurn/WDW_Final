import * as React from "react";
import Navbar from "react-bootstrap/Navbar";
import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
import "bootstrap/dist/css/bootstrap.css";

import { BrowserRouter as Router , Routes, Route, Link } from "react-router-dom";

import Home from "./components/Home";
import About from "./components/about";
import Contact from "./components/contact";
import EditProduct from "./components/product/edit";
import ProductList from "./components/product/List";
import CreateProduct from "./components/product/create";

function App() {
  return (<Router>
    <Navbar bg="primary">
      {/* <Container> */}
        <Link to={"/"} className="navbar-brand text-white">
          Home
        </Link>
        <Link to={"product/"} className="navbar-brand text-white">
          Product
        </Link>
        <Link to={"about/"} className="navbar-brand text-white">
          About
        </Link>
        <Link to={"contact/"} className="navbar-brand text-white">
          Contact
        </Link>
      {/* </Container> */}
    </Navbar>

    <Container className="mt-5">
      <Row>
        <Col md={12}>
          <Routes>
            <Route path="/product/" element={<ProductList />} />
            <Route path="/product/create" element={<CreateProduct />} />
            <Route path="/product/edit/:id" element={<EditProduct />} />
            <Route exact path='/' element={<Home />} />
            <Route path="/about/" element={<About />} />
            <Route path="/contact/" element={<Contact />} />
          </Routes>
        </Col>
      </Row>
    </Container>
  </Router>);
}

export default App;

