import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-left-list',
  templateUrl: './left-list.component.html',
  styleUrls: ['./left-list.component.css']
})
export class LeftListComponent implements OnInit {

  constructor() { }
  data = [
    'Device 1.',
    'Device 2.',
    'Device 3.',
    'Device 4.',
    'Device 5.'
  ];
  ngOnInit() {
  }

}
