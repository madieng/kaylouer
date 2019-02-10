import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class DriverService {
  apiUrl = environment.apiUrl + '/api/drivers';

  constructor(private http: HttpClient) { }

  getDriver(id: number) {
    return this.http.get(this.apiUrl + "-data/" + id);
  }
}
