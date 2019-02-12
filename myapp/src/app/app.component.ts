import { Component,OnInit } from '@angular/core';
import {ApiService} from "./services/api.service";

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent implements OnInit{
  title = 'myapp';
  sms_num = 0;
  sms_array = [];
  constructor(private api:ApiService) { }

  ngOnInit(): void {
    setInterval(v=>{
      this.receiveMSG();
    },5000)
  }

  receiveMSG(){
    this.api.receiveMSG().subscribe(res=>{
      console.log(res);
      if(res[0] == 200){
        if(res[1]['error_code'] == 200){
          this.sms_num = res[1]['unread'];
          this.sms_array = res[1]['sms'];
        }
      }
    })
  }

}
