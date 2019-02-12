import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { HeaderComponent } from './module/header/header.component';
import { LeftListComponent } from './module/left-list/left-list.component';
import { DateTableComponent } from './module/date-table/date-table.component';
import { MsgAreaComponent } from './module/msg-area/msg-area.component';
import { HttpClientModule }    from '@angular/common/http';
import {NgZorroAntdModule} from "ng-zorro-antd";
import {BrowserAnimationsModule} from "@angular/platform-browser/animations";
import {FormsModule} from "@angular/forms";


@NgModule({
  declarations: [
    AppComponent,
    HeaderComponent,
    LeftListComponent,
    DateTableComponent,

    MsgAreaComponent
  ],
  imports: [
    FormsModule,
    BrowserAnimationsModule,
    NgZorroAntdModule,
    BrowserModule,
    HttpClientModule,
    AppRoutingModule
  ],
  providers: [],
  bootstrap: [AppComponent,]
})
export class AppModule { }
