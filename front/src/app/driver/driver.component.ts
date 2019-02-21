import { Component, OnInit } from '@angular/core';
import { DriverService } from '../services/driver/driver.service'
import { Router, ActivatedRoute, ParamMap } from '@angular/router';

@Component({
  selector: 'app-driver',
  templateUrl: './driver.component.html',
  styleUrls: ['./driver.component.css']
})
export class DriverComponent implements OnInit {

  private driver: Object;
  private id: number;

  constructor(
    private driverService : DriverService,
    private route : ActivatedRoute
  ) {
    this.driver = {};
  }

  ngOnInit() {
    this.route.params.subscribe(
      params => this.getDriver(params)
    );
  }

  getDriver(params : any) {
    this.id = params.id;

    this.driverService.getDriver(this.id).subscribe(
      driver => this.driver = driver
    )
  }

}
