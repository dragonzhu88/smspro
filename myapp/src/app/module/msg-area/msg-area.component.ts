import {Component, OnInit} from '@angular/core';
import {ApiService} from "../../services/api.service";

@Component({
  selector: 'app-msg-area',
  templateUrl: './msg-area.component.html',
  styleUrls: ['./msg-area.component.css']
})
export class MsgAreaComponent implements OnInit {

  constructor(private api: ApiService) {
  }

  isVisible = false;
  telPhone;
  smsText;
  saveType;

  showModal(v): void {
    this.saveType = v;
    this.isVisible = true;
  }

  handleOk(): void {
    switch (this.saveType) {
      case'sendSms':
        this.sendSms();
        break;
      case'sendUssd':
        this.sendUssd();
        break;
      case'forward':
        this.forward();
        break;
      case'reply':
        this.reply();
        break;
    }


    console.log('Button ok clicked!');
    this.isVisible = false;
  }

  handleCancel(): void {
    console.log('Button cancel clicked!');
    this.isVisible = false;
  }

  ngOnInit() {
  }

  inputValue;

  sendSms() {
    let params = {
      phone: this.telPhone,
      text: this.smsText
    };
    this.api.sendSms(params).subscribe(json => {
      console.log(json)
    })
  }

  sendUssd() {
    let params = {
      phone: this.telPhone,
      text: this.smsText
    };
    this.api.sendUSSD(params).subscribe(json => {
      console.log(json)
    })
  }

  forward() {

  }

  reply() {

  }


}
