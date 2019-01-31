import { Injectable } from '@angular/core';
import { environment } from 'src/environments/environment';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class AdService {
  apiUrl = environment.apiUrl + '/api/ads';

  constructor(private http: HttpClient) { }

  getAds(page) {
    return this.http.get(this.apiUrl + "?page=" + page);
  }

  getHomeAds(page) {
    return this.http.get(this.apiUrl + "/home?journeys[exists]=true&page=" + page);
  }
}
