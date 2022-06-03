import React, { Component } from 'react'
// import img from "../img/home.jpg";

export default class Home extends Component {
    render() {
        return (
            <header class="bg-secendary py-5">
                    <div class="container px-5">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="">
                                    <h3 class="display-5 fw-bolder text-black mb-2">Mission</h3>
                                    <h3 class="display-5 fw-bolder text-black mb-2">Vision</h3>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="">
                                    <p class="text-black mb-2">Deliver the premium service.
                                    Provide the latest technology of  phone products.
                                    Ensure good relationship with customers at all level.</p>
                                    <br/>
                                    <br/>
                                    <p class=" text-black mb-4">Phone Shop is committed to being a leading phone supplier Cambodia that access the satisfaction level and lives of our customers by our premium products and services.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    {/* <img src={img} alt="product" className="card-img-top blur" /> */}
            </header>
        );
    }
}