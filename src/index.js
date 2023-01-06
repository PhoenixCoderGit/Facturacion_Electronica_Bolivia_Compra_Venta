
import {salir} from "./usuarios/login"
import {Usuarios} from "./usuarios/usuarios"
import {Clientes} from "./clientes/clientes";
import {Categorias} from "./categorias/categorias";
import {Productos} from "./productos/productos";
import {} from "./index.css";
import {VentasFacturacionV1} from "./ventas/ventasFacturacionV1";
import {VentasFacturacionV2} from "./ventas/ventasFacturacionV2";
import {Facturas} from "./facturas/facturas";
import {Reportes} from "./reportes/reportes";
import {Sucursales} from "./sucursales/sucursales";
import {Pos} from "./pos/pos";
import {Configuraciones} from "./configuraciones/configuraciones";
import {Contingencias} from "./facturas/contingencias";
import {Cafcs} from "./facturas/cafcs";
import {Paquetes} from "./facturas/paquetes";
import {Inspecciones} from "./ventas/inspecciones";
import axios from "axios";
import {Correo} from "./configuraciones/correo";
import {Configuraciones2} from "./configuraciones/configuraciones2";


salir()

// USUARIOS

let usuario = new Usuarios();
usuario.mostrar()
usuario.agregar()
usuario.editar()
usuario.editarPerfil()

// PRODUCTOS

let producto = new Productos()
producto.mostrar()
producto.agregar()
producto.editar()

// CLIENTE

let cliente = new Clientes()
cliente.mostrar()
cliente.agregar()
cliente.editar()

// CATEGORIA

let categoria = new Categorias()
categoria.mostrar()
categoria.agregar()
categoria.editar()

// ventas v1

let ventas1 = new VentasFacturacionV1()
ventas1.cargarContenido()
ventas1.generarFactura()

// ventas v2

let ventas2 = new VentasFacturacionV2()
ventas2.cargarContenido()
ventas2.generarFactura()
ventas2.generarFacturaCafc()
ventas2.envioFueraLinea()
ventas2.envioPaquete()

// FACTURAS

let facturas = new Facturas()
facturas.mostrar()

// CONTINGENCIAS

let contingencias = new Contingencias()
contingencias.mostrar()

// CAFC

let cafcs = new Cafcs()
cafcs.mostrar()

// PAQUETES

let paquetes = new Paquetes()
paquetes.mostrar()


// REPORTES

let reportes = new Reportes()
reportes.libroVentas()
reportes.arqueoCaja()

// configuraciones

let configuraciones = new Configuraciones()
configuraciones.mostrar()
configuraciones.editar()

// configuraciones2

let configuraciones2 = new Configuraciones2()
configuraciones2.mostrar()
configuraciones2.editar()

// SUCURSALES

let sucursales = new Sucursales()
sucursales.mostrar()
sucursales.agregar()
sucursales.editar()
sucursales.habilitarCafc()

// POS

let pos = new Pos()
pos.mostrar()
pos.agregar()
pos.editar()

// CORREO

let correo = new Correo()
correo.mostrar()
correo.editar()

/*INSPECCIONES*/

let inspeccion = new Inspecciones()
inspeccion.generarFactura()
inspeccion.envioFueraLineaInspeccion()

/*RETROCEDER*/

let retroceder = document.getElementById("retroceder")
if (retroceder){
    retroceder.addEventListener("click", e =>{
        //window.history.back();
        window.location = "emisionFacturas"
    })
}
