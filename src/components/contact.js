import React, { Component } from 'react'
import img from "../storage/app/public/product/image/th.webp";

export default class Home extends Component {
    render() {
        return (
            <header class="bg-secendary py-5">
                <div class="has-bg-img bg-purple bg-blend-overlay">
                    <div class="container px-5">
                        <div class="row gx-5 justify-content-center">
                            <div class="col-lg-6">
                                <div class="">
                                    <h2 class=" fw-bolder text-black mb-2 text-center">Drop us a line</h2>
                                    <form>
                                        <div class="form-group">
                                            <label for="fname">Full Name </label>
                                            <input type="text" class="form-control"></input>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email Address</label>
                                            <input type="email" class="form-control"></input>
                                        </div>
                                        <div class="form-group">
                                            <label for="message">Message </label>
                                            <textarea rows="4" cols="50" class="form-control"></textarea>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="text-center ">
                                <img src={img} alt="product"  className="card-img-top" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
        );
    }
}