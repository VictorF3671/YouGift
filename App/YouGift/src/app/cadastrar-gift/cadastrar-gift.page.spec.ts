import { ComponentFixture, TestBed } from '@angular/core/testing';
import { CadastrarGiftPage } from './cadastrar-gift.page';

describe('CadastrarGiftPage', () => {
  let component: CadastrarGiftPage;
  let fixture: ComponentFixture<CadastrarGiftPage>;

  beforeEach(() => {
    fixture = TestBed.createComponent(CadastrarGiftPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
