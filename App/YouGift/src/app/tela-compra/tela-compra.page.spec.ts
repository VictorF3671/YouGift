import { ComponentFixture, TestBed } from '@angular/core/testing';
import { TelaCompraPage } from './tela-compra.page';

describe('TelaCompraPage', () => {
  let component: TelaCompraPage;
  let fixture: ComponentFixture<TelaCompraPage>;

  beforeEach(() => {
    fixture = TestBed.createComponent(TelaCompraPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
