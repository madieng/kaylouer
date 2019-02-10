import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { HomepageComponent } from './homepage/homepage.component';
import { DriverComponent } from './driver/driver.component';

const routes: Routes = [
  { path: '', component: HomepageComponent },
  { path: 'driver/:id', component: DriverComponent }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
