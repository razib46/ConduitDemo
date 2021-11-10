import { NgModule } from '@angular/core';

import { HomeComponent } from './home.component';
import { HomeAuthResolver } from './home-auth-resolver.service';
import { SharedModule } from '../shared';
import { HomeRoutingModule } from './home-routing.module';
import { PopularTagsComponent } from './popular-tags.component';
import { PopularUsersComponent } from './popular-users.component';

@NgModule({
  imports: [
    SharedModule,
    HomeRoutingModule
  ],
  declarations: [
    HomeComponent,
    PopularTagsComponent,
    PopularUsersComponent
  ],
  providers: [
    HomeAuthResolver
  ]
})
export class HomeModule { }
