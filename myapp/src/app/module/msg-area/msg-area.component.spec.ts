import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { MsgAreaComponent } from './msg-area.component';

describe('MsgAreaComponent', () => {
  let component: MsgAreaComponent;
  let fixture: ComponentFixture<MsgAreaComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ MsgAreaComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(MsgAreaComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
