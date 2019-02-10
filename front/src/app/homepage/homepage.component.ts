import { Component, OnInit } from '@angular/core';
import { AdService } from '../services/ad/ad.service';
import { StatusJourney } from '../models/statusJourney';


@Component({
  selector: 'app-homepage',
  templateUrl: './homepage.component.html',
  styleUrls: ['./homepage.component.css']
})
export class HomepageComponent implements OnInit {
  public ads;
  public totalItems : number;
  public page: number = 1;
  StatusJourney = StatusJourney;

  constructor(
    private adService: AdService
  ) {

  }

  ngOnInit() {
    this.initAds();
  }

  pageChanged(event) {
    this.page = event;
    this.initAds();
  }

  initAds() {
    this.adService.getHomeAds(this.page).subscribe(data => {
      this.ads = data['hydra:member'];
      this.totalItems = data['hydra:totalItems'];
    });
  }

}
