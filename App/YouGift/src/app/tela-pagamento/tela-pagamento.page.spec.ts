import { ComponentFixture, TestBed } from '@angular/core/testing';
import { TelaPagamentoPage } from './tela-pagamento.page';

describe('TelaPagamentoPage', () => {
  let component: TelaPagamentoPage;
  let fixture: ComponentFixture<TelaPagamentoPage>;

  beforeEach(() => {
    fixture = TestBed.createComponent(TelaPagamentoPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
