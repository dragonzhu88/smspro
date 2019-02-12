import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-date-table',
  templateUrl: './date-table.component.html',
  styleUrls: ['./date-table.component.css']
})
export class DateTableComponent implements OnInit {

  constructor() { }

  dataSet = [
    {
      key    : '1',
      type   : 'John Brown',
      peerNo    : 32,
      msg: 'New York No. 1 Lake Park',
      port: 80,
      time: 30,
      ipAddr: '192.168.1.1',
      macAddr: '00-00-00-00-00-00',
    },
    {
      key    : '2',
      type   : 'John Brown',
      peerNo    : 32,
      msg: 'New York No. 1 Lake Park',
      port: 80,
      time: 30,
      ipAddr: '192.168.1.1',
      macAddr: '00-00-00-00-00-00',
    },
    {
      key    : '3',
      type   : 'John Brown',
      peerNo    : 32,
      msg: 'New York No. 1 Lake Park',
      port: 80,
      time: 30,
      ipAddr: '192.168.1.1',
      macAddr: '00-00-00-00-00-00',
    }
  ];

  ngOnInit() {
  }

}
