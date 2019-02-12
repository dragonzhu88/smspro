import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { LeftListComponent } from './left-list.component';

describe('LeftListComponent', () => {
  let component: LeftListComponent;
  let fixture: ComponentFixture<LeftListComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ LeftListComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(LeftListComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
