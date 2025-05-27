import { ComponentFixture, TestBed } from '@angular/core/testing';
import { UsuariosCadastradosPage } from './usuarios-cadastrados.page';

describe('UsuariosCadastradosPage', () => {
  let component: UsuariosCadastradosPage;
  let fixture: ComponentFixture<UsuariosCadastradosPage>;

  beforeEach(() => {
    fixture = TestBed.createComponent(UsuariosCadastradosPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
