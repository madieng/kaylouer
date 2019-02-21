import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { HomepageComponent } from './homepage/homepage.component';
import { DriverComponent } from './driver/driver.component';
import { CustomerComponent } from './customer/customer.component';

const routes: Routes = [
  { path: '', component: HomepageComponent },
  { path: 'driver/:id', component: DriverComponent },
  { path: 'customer/:id', component: CustomerComponent }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
