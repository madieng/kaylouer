import { Component, OnInit } from '@angular/core';
import { CustomerService } from '../services/customer/customer.service'
import { ActivatedRoute} from '@angular/router';

@Component({
  selector: 'app-customer',
  templateUrl: './customer.component.html',
  styleUrls: ['./customer.component.css']
})
export class CustomerComponent implements OnInit {
  private customer: Object;
  private id: number;

  constructor(
    private route : ActivatedRoute,
    private customerService: CustomerService
  ) {
    this.customer = {};
   }

  ngOnInit() {
    this.route.params.subscribe(
      params => this.getCustomer(params)
    );
  }

  getCustomer(params : any) {
    this.id = params.id;

    this.customerService.getCustomer(this.id).subscribe(
      customer => this.customer = customer
    )
  }

}
