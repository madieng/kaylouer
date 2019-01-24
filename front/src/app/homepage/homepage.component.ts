import { Component, OnInit } from '@angular/core';
import { AdService } from '../services/ad.service';

@Component({
  selector: 'app-homepage',
  templateUrl: './homepage.component.html',
  styleUrls: ['./homepage.component.css']
})
export class HomepageComponent implements OnInit {
  public ads;
  public totalItems;
  public page: number = 1;


  constructor(private adService: AdService) { }

  ngOnInit() {
    this.initAds();
  }

  pageChanged(event) {
    this.page = event;
    this.initAds();
  }

  initAds() {
    this.adService.getAds(this.page).subscribe(data => {
      this.ads = data['hydra:member'];
      this.totalItems = data['hydra:totalItems'];
    });
  }

}
