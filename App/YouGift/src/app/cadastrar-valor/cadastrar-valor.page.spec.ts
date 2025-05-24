import { ComponentFixture, TestBed } from '@angular/core/testing';
import { CadastrarValorPage } from './cadastrar-valor.page';

describe('CadastrarValorPage', () => {
  let component: CadastrarValorPage;
  let fixture: ComponentFixture<CadastrarValorPage>;

  beforeEach(() => {
    fixture = TestBed.createComponent(CadastrarValorPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
