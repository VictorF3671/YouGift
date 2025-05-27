import { ComponentFixture, TestBed } from '@angular/core/testing';
import { GiftsCadastradosPage } from './gifts-cadastrados.page';

describe('GiftsCadastradosPage', () => {
  let component: GiftsCadastradosPage;
  let fixture: ComponentFixture<GiftsCadastradosPage>;

  beforeEach(() => {
    fixture = TestBed.createComponent(GiftsCadastradosPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
